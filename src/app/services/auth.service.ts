import { Injectable } from '@angular/core';
import * as firebase from 'firebase';
import DataSnapshot = firebase.database.DataSnapshot;


@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor() { }


  createNewUser(email: string, password: string, admin: boolean) {
    return new Promise(
      (resolve, reject) => {
        firebase.auth().createUserWithEmailAndPassword(email, password).then(
          (authUser) => {
            var roles;
            if (admin) {
                  roles = "BIBLIOTHECAIRE";
              } else{
                  roles = "USER";
              }
              firebase.database().ref('users/' + authUser.user.uid).set({
                roles : roles,
                email: email
              });




              // Ajouter les email a la base de donnée une par une pour lister les users (Idee crée un model user)
            resolve();
          },
          (error) => {
            reject(error);
          }
        );
      }
    );
}

signInUser(email: string, password: string) {
    return new Promise(
      (resolve, reject) => {
        firebase.auth().signInWithEmailAndPassword(email, password).then(
          (authUser) => {
            var userId = authUser.user.uid;
            firebase.database().ref('/users/' + userId).once('value').then(function(snapshot) {
                var roles =  snapshot.val().roles;
                console.log("On est laaa")
            });

            resolve();
          },
          (error) => {
            reject(error);
          }
        );
      }
    );
}
signOutUser() {
    firebase.auth().signOut();
}


}
