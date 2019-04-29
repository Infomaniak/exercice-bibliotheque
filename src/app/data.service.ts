import { Injectable } from '@angular/core';
import { Observable, throwError } from 'rxjs';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { catchError, map } from 'rxjs/operators';

const ApiUrl = "http://localhost/api/books";

@Injectable({
  providedIn: 'root'
})
export class DataService {

  constructor(private http: HttpClient) { }

  private handleError(error: HttpErrorResponse) {
    if (error.error instanceof ErrorEvent) {
      // A client-side or network error occurred. Handle it accordingly.
      console.error('An error occurred:', error.message);
    } else {
      // The backend returned an unsuccessful response code.
      // The response body may contain clues as to what went wrong,
      console.error(error);
      console.error(
        `Backend returned code ${error.status}, ` +
        `body was: ${error.message}`);
    }
    // return an observable with a user-facing error message
    //return throwError(error.error.message);
    return throwError(error.message);
  }

  private extractData(res: Response) {
    let body = res;
    return body || { };
  }

  getBooks(): Observable<any> {
    return this.http.get(ApiUrl + "/read.php").pipe(
      map(this.extractData),
      catchError(this.handleError));
  }

  getBook(id: any): Observable<any> {
    const url = `${ApiUrl}/read_one.php?id=${id}`;
    return this.http.get(url).pipe(
      map(this.extractData),
      catchError(this.handleError));
  }

  getBookWithUser(id: any): Observable<any> {
    const url = `${ApiUrl}/read_one_with_user.php?id=${id}`;
    return this.http.get(url).pipe(
      map(this.extractData),
      catchError(this.handleError));
  }

  getBorrowedBooks(id: any): Observable<any> {
    const url = `${ApiUrl}/read_borrowed.php?id=${id}`;
    return this.http.get(url).pipe(
      map(this.extractData),
      catchError(this.handleError));
  }

  addBook(data: any): Observable<any> {
    const url = `${ApiUrl}/create.php`;
    return this.http.post(url, data).pipe(
      map(this.extractData),
      catchError(this.handleError)
    );
  }

  updateBook(data: any): Observable<any> {
    const url = `${ApiUrl}/update.php`;
    return this.http.post(url, data).pipe(
      map(this.extractData),
      catchError(this.handleError)
    );
  }

  borrowBook(data: any): Observable<any> {
    const url = `${ApiUrl}/borrow.php`;
    return this.http.post(url, data).pipe(
      map(this.extractData),
      catchError(this.handleError)
    );
  }

  returnBook(data: any): Observable<any> {
    const url = `${ApiUrl}/return.php`;
    return this.http.post(url, data).pipe(
      map(this.extractData),
      catchError(this.handleError)
    );
  }

  deleteBook(data: any): Observable<any> {
    const url = `${ApiUrl}/delete.php`;
    return this.http.post(url, data).pipe(
      map(this.extractData),
      catchError(this.handleError)
    );
  }
}
