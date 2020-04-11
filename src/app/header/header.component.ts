import { Component, OnInit } from '@angular/core';
import { AuthService } from '../services/auth.service';
import { AdminService } from '../services/admin.service';

import * as firebase from 'firebase';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {
  admin: Boolean = false;
  isAuth: Boolean;

  constructor(private authService: AuthService, private adminService: AdminService) { }


  ngOnInit() {
    firebase.auth().onAuthStateChanged(
      (user) => {
        if(user) {
          this.isAuth = true;
        } else {
          this.isAuth = false;
        }
        return this.adminService
            .myRole()
            .then(roles => {
              if(roles == "BIBLIOTHECAIRE") {
                this.admin = true;
              } else if (roles == "USER"){
                this.admin = false;
              } else {
                this.admin = false;
              }
            });
      }
    );
  }

  onSignOut() {
    this.authService.signOutUser();
    this.admin = false;
  }

}
