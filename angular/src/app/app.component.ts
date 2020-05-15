import { Component } from '@angular/core';

import { IpAddress } from './subnet';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  selectedIp: IpAddress;

  selectIp($event) {
    this.selectedIp = $event;
  }
}
