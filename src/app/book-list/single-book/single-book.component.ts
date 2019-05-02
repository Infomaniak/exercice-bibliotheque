import { Component, OnInit } from '@angular/core';
import { Book } from '../../models/book.model';
import { ActivatedRoute, Router } from '@angular/router';
import { BooksService } from '../../services/books.service';
import { AdminService } from '../../services/admin.service';

@Component({
  selector: 'app-single-book',
  templateUrl: './single-book.component.html',
  styleUrls: ['./single-book.component.scss']
})
export class SingleBookComponent implements OnInit {
  edit: boolean = false;
  book: Book;
  admin: Boolean = false;

  constructor(private route: ActivatedRoute, private booksService: BooksService, private adminService: AdminService,
              private router: Router) {}

  ngOnInit() : Promise<any> {
    this.book = new Book('', '');
    const id = this.route.snapshot.params['id'];
    this.booksService.getSingleBook(+id).then(
      (book: Book) => {
        this.book = book;
      }
    );

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

  onBack() {
    this.router.navigate(['/books']);
  }

  Onedit(){

    this.edit= true;
    console.log(this.edit);
  }
  BookStatus() {
  this.booksService.bookUpdate(this.book.title, this.book.author, this.book.synopsis, this.route.snapshot.params['id']);
  this.edit= false;

  }
  

}
