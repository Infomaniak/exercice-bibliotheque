import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
import { Observable } from 'rxjs/Observable';
import * as firebase from 'firebase';

@Injectable()
export class AdminGuardService implements CanActivate {

  constructor(private router: Router) {}

  canActivate(): Observable<boolean> | Promise<boolean> | boolean {
    return new Promise(
      (resolve, reject) => {
        firebase.auth().onAuthStateChanged(
          (user) => {
            if(user) {
            var userId = user.uid
            var roles;
            firebase.database().ref('/users/' + userId).once('value').then((snapshot) => {
                roles =  snapshot.val().roles;
                console.log(roles);
                var admin;
                if(roles == "BIBLIOTHECAIRE") {
                  resolve(true);
                } else if (roles == "USER"){
                  this.router.navigate(['/books']);
                  resolve(false);
                } else {
                  this.router.navigate(['/books']);
                  resolve(false);
                }

              });
          } else {
            this.router.navigate(['/auth', 'signin']);
            resolve(false);
          }
        });
      }
    );
  }
}
