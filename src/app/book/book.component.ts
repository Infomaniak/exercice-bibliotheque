import { Component, OnInit, OnDestroy } from '@angular/core';
import { Title } from '@angular/platform-browser';
import { ActivatedRoute, Router } from "@angular/router";
import { Subscription } from 'rxjs';
import { MatDialog } from '@angular/material';

import { DataService } from '../data.service';
import { AuthService } from '../auth.service';
import { AlertService } from '../alert.service';
import { BookDialogComponent } from '../book-dialog/book-dialog.component';
import { ConfirmDialogComponent } from '../confirm-dialog/confirm-dialog.component';

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
  selector: 'app-book',
  templateUrl: './book.component.html',
  styleUrls: ['./book.component.scss']
})
export class BookComponent implements OnInit, OnDestroy {

  livre: Object;
  id: any;
  subscriptions: Subscription[] = new Array();
  type: number;

  constructor(private dialog: MatDialog, 
              private api: DataService, 
              private authService: AuthService,
              private alert: AlertService, 
              private title: Title, 
              private route: ActivatedRoute, 
              private router: Router) {
    this.subscriptions.push(this.route.params.subscribe( params => this.id = params.id ));
   }

  ngOnInit() {
    this.type = this.authService.currentUserValue.type;
    if(this.type == 0){
      this.subscriptions.push(this.api.getBook(this.id)
        .subscribe( data => {
          data['OriginalDate'] = new Date(data['date']);
          data['date'] = this.convertDate(new Date(data['date']));
          this.livre = data;
          this.title.setTitle("Infomaniak Application - " + this.livre['titre']);
        }, err => {
          this.alert.error(err);
        }));
    } else if(this.type == 1) {
      this.subscriptions.push(this.api.getBookWithUser(this.id)
        .subscribe( data => {
          data['OriginalDate'] = new Date(data['date']);
          data['date'] = this.convertDate(new Date(data['date']));
          this.livre = data;
          this.title.setTitle("Infomaniak Application - " + this.livre['titre']);
        }, err => {
          this.alert.error(err);
        }));
    } else {
      this.alert.error("Erreur, modification de l'utilisateur detectée.");
      this.authService.logout();
    }
  }

  ngOnDestroy() {
    this.subscriptions.forEach(subscription => {
      subscription.unsubscribe();
    });
  }

  openModifyDialog(): void {
    const dialogRef = this.dialog.open(BookDialogComponent, {
      width: '350px',
      data: {
        title: "Modifier un livre",
        info: {
          id: this.livre['id'],
          titre: this.livre['titre'],
          auteur: this.livre['auteur'],
          genre: this.livre['genre'],
          type: this.livre['type'],
          date: this.livre['OriginalDate'],
          dispo: this.livre['dispo'] == 1 ? 'TRUE' : 'FALSE'
        },
        button: "Modifier"
      }
    });

    dialogRef.afterClosed().subscribe(result => {
      let info = result;
      if (info){
        info.date = this.convertDateForSQL(info.date);
        this.api.updateBook(info)
          .subscribe(res => {
            this.alert.success("Modification réussie");
            this.ngOnInit();
          }, err => {
            this.alert.error(err);
          });
      }
    });
  }

  openDeleteDialog(): void {
    const dialogRef = this.dialog.open(ConfirmDialogComponent, {
      width: '350px',
      data: {
        title: "Supprimer un livre", 
        message: "Voulez-vous vraiment supprimer le livre " + this.livre['titre'] + " ?",
        button: "Supprimer"
      }
    });

    dialogRef.afterClosed().subscribe(result => {
      let info = result;
      if (info){
        this.api.deleteBook({'id': this.id})
          .subscribe(res => {
            this.alert.success("Suppression réussie");
            this.router.navigate(['/']);
          }, err => {
            this.alert.error(err);
          });
      }
    });
  }

  openBorrowDialog(): void {
    const dialogRef = this.dialog.open(ConfirmDialogComponent, {
      width: '350px',
      data: {
        title: "Emprunter un livre", 
        message: "Voulez-vous vraiment emprunter le livre " + this.livre['titre'] + " ?",
        button: "Emprunter"
      }
    });

    dialogRef.afterClosed().subscribe(result => {
      let info = result;
      if (info){
        let data = { 
          'idUser': this.authService.currentUserValue.id,
          'idBook': this.livre['id']
        }
        this.api.borrowBook(data)
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

  convertDateForSQL(date) {
    let aux = [date.getDate(), date.getMonth()+1, date.getFullYear()];
    return (
      aux[2] + '-' +
      (aux[1] > 9 ? '' : '0') + aux[1] + '-' +
      (aux[0] > 9 ? '' : '0') + aux[0]
    );
  }

}
