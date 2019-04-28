import { Component, OnInit, OnDestroy } from '@angular/core';
import { Title } from '@angular/platform-browser';
import { Subscription } from 'rxjs';
import { MatDialog } from '@angular/material';

import { DataService } from '../data.service';
import { AuthService } from '../auth.service';
import { AlertService } from '../alert.service';
import { BookDialogComponent } from '../book-dialog/book-dialog.component';

export interface BookDataSource {
  id: any,
  titre: string,
  auteur: string,
  genre: string,
  type: string,
  date: string,
  dispo: string
}

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit, OnDestroy {

  livres: Object[];
  subscriptions: Subscription[];
  type: any;

  constructor(private dialog: MatDialog, private api: DataService, private alert: AlertService, private title: Title, private authService: AuthService) { 
    this.type = this.authService.currentUserValue.type;
  }

  ngOnInit() {
    this.subscriptions = new Array();
    this.title.setTitle("Infomaniak Application - Livres");
    this.subscriptions.push( this.api.getBooks()
      .subscribe( data => {
        this.livres = data["books"];
        this.livres.forEach(each => {
          each['Date'] = this.convertDate(new Date(each['Date']));
        })
      }, err => {
        this.alert.error(err);
      }));
  }

  ngOnDestroy() {
    this.subscriptions.forEach(subscription => {
      subscription.unsubscribe();
    });
  }

  openAddDialog(): void {
    const dialogRef = this.dialog.open(BookDialogComponent, {
      width: '350px',
      data: {
        title: "Ajouter un livre",
        info: {
          id: "",
          titre: "",
          auteur: "",
          genre: "",
          type: "",
          date: "",
          dispo: ""
        },
        button: "Ajouter"
      }
    });

    this.subscriptions.push(dialogRef.afterClosed()
      .subscribe(result => {
        let info = result;
        if (info) {
          info.date = this.convertDateForSQL(info.date);
          this.subscriptions.push(this.api.addBook(info)
            .subscribe(res => {
              this.alert.success("Ajout réussi");
              this.ngOnInit();
            }, err => {
              this.alert.error(err);
            }));
        }
      }, err => {
        this.alert.error(err);
      })
    );
  }

  convertDate(date) {
    let aux = [date.getDate(), date.getMonth()+1, date.getFullYear()];
    return (
      (aux[0] > 9 ? '' : '0') + aux[0] + '/' +
      (aux[1] > 9 ? '' : '0') + aux[1] + '/' +
      aux[2]
    );
  }

  convertDateForSQL(date) {
    let aux = [date.getDate(), date.getMonth()+1, date.getFullYear()];
    return (
      aux[2] + '-' +
      (aux[1] > 9 ? '' : '0') + aux[1] + '-' +
      (aux[0] > 9 ? '' : '0') + aux[0]
    );
  }

}
