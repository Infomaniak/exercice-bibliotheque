import { Component } from '@angular/core';
import * as firebase from 'firebase';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  // Initialize Firebase
  constructor() {
  var config = {
    apiKey: "AIzaSyBH_veHBdwfGkELLYfF3-YGTNmf4fkYs1A",
    authDomain: "shop-books.firebaseapp.com",
    databaseURL: "https://shop-books.firebaseio.com",
    projectId: "shop-books",
    storageBucket: "shop-books.appspot.com",
    messagingSenderId: "769885009085"
  };
  firebase.initializeApp(config);
 }
}
