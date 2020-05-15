import { Component, Input, OnInit } from '@angular/core';

import { IpAddress } from '../subnet';

@Component({
  selector: 'app-ip',
  templateUrl: './ip.component.html',
  styleUrls: ['./ip.component.scss']
})
export class IpComponent implements OnInit {

  @Input() ip: IpAddress;

  constructor() { }

  ngOnInit(): void {
  }

}
