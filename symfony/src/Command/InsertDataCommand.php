<?php

namespace App\Command;

use App\Entity\IpAddress;
use App\Entity\Subnet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InsertDataCommand extends Command
{
    protected static $defaultName = 'subnets:insert';

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Inserts data from subnets.json')
            ->setHelp('Reads data from data/subnets.json and inserts it into MySQL');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $jsonString = file_get_contents(__DIR__ . '/../../data/subnets.json');
        if ($jsonString === false) {
            $output->writeln('Failed to open subnets.json');
            return 1;
        }

        $subnets = json_decode($jsonString, true);
        if ($subnets === null) {
            $output->writeln('Failed to parse subnets JSON');
            return 2;
        }

        foreach ($subnets as $subnet) {
            $subnetEntity = new Subnet();
            $subnetEntity->setSubnet($subnet['subnet']);
            $subnetEntity->setCidr($subnet['cidr']);
            $this->entityManager->persist($subnetEntity);
            $this->entityManager->flush();

            foreach ($subnet['ips'] as $ip) {
                $ipEntity = new IpAddress();
                $ipEntity->setIp($ip['ip']);
                $ipEntity->setAddressTag($ip['address_tag']);
                $subnetEntity->addIpAddress($ipEntity);
                $this->entityManager->persist($ipEntity);
            }
            $this->entityManager->flush();

            $output->writeln('Added ' . $subnetEntity->getSubnet() . '/' . $subnetEntity->getCidr() . ' with ' . count($subnetEntity->getIpAddresses()) . ' IP addresses');
        }

        return 0;
    }
}