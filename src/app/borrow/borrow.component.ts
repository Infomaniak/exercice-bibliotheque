import { Component, OnInit, OnDestroy } from '@angular/core';
import { Title } from '@angular/platform-browser';
import { Subscription } from 'rxjs';
import { MatDialog } from '@angular/material';

import { DataService } from '../data.service';
import { AlertService } from '../alert.service';
import { AuthService } from '../auth.service';
import { ConfirmDialogComponent } from '../confirm-dialog/confirm-dialog.component';

@Component({
  selector: 'app-borrow',
  templateUrl: './borrow.component.html',
  styleUrls: ['./borrow.component.scss']
})
export class BorrowComponent implements OnInit, OnDestroy {

  livres: Object[];
  subscriptions: Subscription[] = new Array();

  constructor(private dialog: MatDialog, 
              private api: DataService, 
              private alert: AlertService, 
              private title: Title,
              private authService: AuthService) { }

  ngOnInit() {
    this.title.setTitle("Infomaniak App - Emprunts");
    let id = this.authService.currentUserValue.id;
    this.subscriptions.push( this.api.getBorrowedBooks(id)
      .subscribe( data => {
        if(undefined != data["books"]){
          this.livres = data["books"];
          this.livres.forEach(each => {
            each['Date'] = this.convertDate(new Date(each['Date']));
          })
        } else {
          this.livres = null;
          this.alert.success("Aucun livre emprunté.");
        }
      }, err => {
        this.alert.error(err);
      }));
  }

  ngOnDestroy() {
    this.subscriptions.forEach(subscription => {
      subscription.unsubscribe();
    });
  }

  openBorrowDialog(id, titre): void {
    const dialogRef = this.dialog.open(ConfirmDialogComponent, {
      width: '350px',
      data: {
        title: "Rendre un livre", 
        message: "Voulez-vous vraiment rendre le livre " + titre + " ?",
        button: "Rendre"
      }
    });

    dialogRef.afterClosed().subscribe(result => {
      let info = result;
      if (info){
        let data = { 
          'idUser': this.authService.currentUserValue.id,
          'idBook': id
        }
        this.api.returnBook(data)
          .subscribe(res => {
            this.ngOnInit();
          }, err => {
            this.alert.error(err);
          });
      }
    });
  }

  convertDate(date) {
    let aux = [date.getDate(), date.getMonth()+1, date.getFullYear()];
    return (
      (aux[0] > 9 ? '' : '0') + aux[0] + '/' +
      (aux[1] > 9 ? '' : '0') + aux[1] + '/' +
      aux[2]
    );
  }

}
