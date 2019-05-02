import { Component, OnInit } from '@angular/core';
import { UserService } from '../services/user.service';


@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.scss']
})
export class AdminComponent implements OnInit {
   users = [];

  constructor(private userService: UserService) { }

  ngOnInit(): Promise<any> {

    return this.userService
        .getUsers()
        .then(michel => {
          Object.assign(this.users, michel);
        });
  }
}
