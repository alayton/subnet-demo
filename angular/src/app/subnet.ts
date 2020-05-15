export interface Subnet {
    id: number;
    subnet: string;
    cidr: number;
    ip_addresses: IpAddress[];
}

export interface IpAddress {
    id: number;
    ip: string;
    address_tag: string;
    subnet: string;
}