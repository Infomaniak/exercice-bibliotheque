import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { map } from 'rxjs/operators';

export class User {
  id: number;
  username: string;
  password: string;
  nom: string;
  prenom: string;
  type: number;
  token: string;
}
const ApiUrl = "https://maximetassy.fr/api/users";

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private currentUserSubject: BehaviorSubject<User>;
  public currentUser: Observable<User>;

  constructor(private http: HttpClient) {
    this.currentUserSubject = new BehaviorSubject<User>(JSON.parse(localStorage.getItem('currentUserInfomaniakApp')));
    this.currentUser = this.currentUserSubject.asObservable();
  }

  public get currentUserValue(): User {
    return this.currentUserSubject.value;
  }

  login(username: string, password: string) {
    return this.http.post<any>(`${ApiUrl}/login.php`, { 'username': username, 'password': password })
      .pipe(map(user => {
        if (user && user.token) {
          localStorage.setItem('currentUserInfomaniakApp', JSON.stringify(user));
          this.currentUserSubject.next(user);
        }

        return user;
      }));
  }

  logout() {
    localStorage.removeItem('currentUserInfomaniakApp');
    this.currentUserSubject.next(null);
  }
}
