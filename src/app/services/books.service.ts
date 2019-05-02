import { Injectable } from '@angular/core';
import { Subject } from 'rxjs/Subject';
import { Book } from '../models/book.model';
import * as firebase from 'firebase/app';
import DataSnapshot = firebase.database.DataSnapshot;


@Injectable()
export class BooksService {

  books: Book[] = [];
  booksSubject = new Subject<Book[]>();



  emitBooks() {
    this.booksSubject.next(this.books);
  }

  saveBooks() {
    console.log(this.books);
    firebase.database().ref('/books').set(this.books);
}

getBooks() {
    firebase.database().ref('/books')
      .on('value', (data: DataSnapshot) => {
          this.books = data.val() ? data.val() : [];
          this.emitBooks();
        }
      );
  }

  getSingleBook(id: number) {
    return new Promise(
      (resolve, reject) => {
        firebase.database().ref('/books/' + id).once('value').then(
          (data: DataSnapshot) => {
            console.log(data.val().photo)
            resolve(data.val());
          }, (error) => {
            reject(error);
          }
        );
      }
    );
  }

  constructor() {
    this.getBooks();
}

createNewBook(newBook: Book) {
  console.log(newBook);
    this.books.push(newBook);
    this.saveBooks();
    this.emitBooks();
  }

  removeBook(book: Book) {
    if(book.photo) {
      const storageRef = firebase.storage().refFromURL(book.photo);
      storageRef.delete().then(
        () => {
          console.log('Photo removed!');
        },
        (error) => {
          console.log('Could not remove photo! : ' + error);
        }
      );
    }
    const bookIndexToRemove = this.books.findIndex(
      (bookEl) => {
        if(bookEl === book) {
          return true;
        }
      }
    );
    console.log("Before");
    console.log(this.books);
    this.books[bookIndexToRemove] = null;

    console.log("After");
    console.log(this.books);
    this.saveBooks();
    this.emitBooks();
}





unFollowBook(bookId) {

      var newData={
          subscriber: null,
          email: null
      }
    firebase.database().ref('books/' + bookId + "/").update(newData);



}




  uploadFile(file: File) {
    return new Promise(
      (resolve, reject) => {
        const almostUniqueFileName = Date.now().toString();
        const upload = firebase.storage().ref()
          .child('images/' + almostUniqueFileName + file.name).put(file);
        upload.on(firebase.storage.TaskEvent.STATE_CHANGED,
          () => {
            console.log('Chargement…');
          },
          (error) => {
            console.log('Erreur de chargement ! : ' + error);
            reject();
          },
          () => {
            resolve(upload.snapshot.ref.getDownloadURL());
          }
        );
      }
    );
}










followBook(bookId, userId, email) {
      var newData={
          subscriber: userId,
          email: email
      }
      firebase.database().ref('books/' + bookId + "/").update(newData);
}
bookUpdate(title, author, synopsis, id){

  var newData={
      author: author,
      title: title,
      synopsis: synopsis
  }
firebase.database().ref('books/' + id + "/").update(newData);


}




}
