import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

export class User {
  id: number;
  username: string;
  password: string;
  nom: string;
  prenom: string;
  type: number;
  token: string;
}
const apiUrl = 'http://localhost/api/users'

@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(private http: HttpClient) { }

  register(user: User) {
    return this.http.post(`${apiUrl}/register.php`, user);
  }

  update(user: User) {
    return this.http.post(`${apiUrl}/update.php`, user);
  }
}
