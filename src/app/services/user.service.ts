import { Injectable } from '@angular/core';
import * as firebase from 'firebase';


export class UserService {

  getUsers() {
      return new Promise(
        (resolve, reject) => {
          var users;
          firebase.database().ref('/users/').once('value').then(function(snapshot) {
              var users = Object.values(snapshot.val());
              resolve(users);
            });
            console.log("user works");
        }
      );
  }




}
