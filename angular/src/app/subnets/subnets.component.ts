import { Component, EventEmitter, OnInit, Output } from '@angular/core';

import { IpAddress, Subnet } from '../subnet';
import { SubnetService } from '../subnet.service';

@Component({
  selector: 'app-subnets',
  templateUrl: './subnets.component.html',
  styleUrls: ['./subnets.component.scss']
})
export class SubnetsComponent implements OnInit {
  public isExpanded: { [key: string]: boolean } = {};
  public subnets: Subnet[];
  public selectedIp: IpAddress;

  @Output() ipEvent = new EventEmitter<IpAddress>();

  constructor(
    private subnetService: SubnetService,
  ) { }

  ngOnInit(): void {
    this.getSubnets();
  }

  getSubnets(): void {
    this.subnetService.getSubnets().subscribe(subnets => this.subnets = subnets);
  }

  clickIp(ip: IpAddress): void {
    this.selectedIp = ip;
    this.ipEvent.emit(ip);
  }

  trackByFn(idx: number, item: Subnet | IpAddress) {
    if (!item) {
      return null;
    }
    return item.id;
  }
}
