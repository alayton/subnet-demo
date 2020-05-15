import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

import { environment } from '../environments/environment';
import { Subnet } from './subnet';

@Injectable({
  providedIn: 'root'
})
export class SubnetService {
  private getEndpoint = `${environment.backendUrl}/subnets`;
  private normalized: { [key: string]: string } = {};

  constructor(
    private http: HttpClient,
  ) { }

  private normalize(subnet): string {
    let norm = this.normalized[subnet];
    if (!norm) {
      this.normalized[subnet] = norm = subnet.split('.').map((part: string) => part.padStart(3, '0')).join('.');
    }
    return norm;
  }

  getSubnets(): Observable<Subnet[]> {
    return this.http.get<Subnet[]>(this.getEndpoint).pipe(
      // Two goals here: sort the subnets, add the subnet to each IpAddress belonging to it
      map<Subnet[], Subnet[]>(subnets => {
        subnets.sort((a, b): number => {
          const normA = this.normalize(a.subnet);
          const normB = this.normalize(b.subnet);
          if (normA < normB) {
            return -1;
          } else if (normA > normB) {
            return 1;
          }
          return 0;
        });

        subnets.forEach(net => {
          net.ip_addresses.forEach(address => address.subnet = net.subnet);
        });
        return subnets;
      })
    );
  }
}
