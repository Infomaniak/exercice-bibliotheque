import { Component, OnInit, OnDestroy } from '@angular/core';
import { Router } from '@angular/router';

import { AuthService } from '../auth.service';
import { Subscription } from 'rxjs';

@Component({
  selector: 'app-nav',
  templateUrl: './nav.component.html',
  styleUrls: ['./nav.component.scss']
})
export class NavComponent implements OnInit, OnDestroy {
  currentUser: any = null;
  subscribe: Subscription;

  appTitle = 'InfomaniakApp';

  constructor(private authService: AuthService, private router: Router) { }

  ngOnInit() {
    this.subscribe = this.authService.currentUser.subscribe(x => this.currentUser = x);
  }

  ngOnDestroy(): void {
    this.subscribe.unsubscribe();
  }

  logout() {
    this.authService.logout();
    this.router.navigate(['/login']);
  }

}
