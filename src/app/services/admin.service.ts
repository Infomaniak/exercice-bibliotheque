import { Injectable } from '@angular/core';
import * as firebase from 'firebase';


export class AdminService {

  myRole() {
      return new Promise(
        (resolve, reject) => {
          var userId;
          firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
              var userId = user.uid
              var roles;
              firebase.database().ref('/users/' + userId).once('value').then((snapshot) => {
                  console.log(snapshot.val())
                  roles =  snapshot.val().roles;
                  resolve(roles);
                });
            } else {
              console.log("Vous etes pas connecter");
            }
          });
        }
      );
  }




}
