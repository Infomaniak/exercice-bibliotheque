import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';

import { AlertService } from '../alert.service';
import { UserService } from '../user.service';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-account',
  templateUrl: './account.component.html',
  styleUrls: ['./account.component.scss']
})
export class AccountComponent implements OnInit {
  form: FormGroup;
  loading = false;
  submitted = false;

  constructor(
    private formBuilder: FormBuilder,
    private authService: AuthService,
    private userService: UserService,
    private alert: AlertService
  ) { }

  ngOnInit() {
    let user = this.authService.currentUserValue;
    this.form = this.formBuilder.group({
      prenom: [user.prenom, Validators.required],
      nom: [user.nom, Validators.required],
      username: [{value: user.username, disabled: true}],
      oldpassword: ['', [Validators.required, Validators.minLength(6)]],
      newpassword: ['', [Validators.required, Validators.minLength(6)]]
    });
  }

  get f() { return this.form.controls; }

  onSubmit() {
    this.submitted = true;

    // stop here if form is invalid
    if (this.form.invalid) {
      return;
    }

    this.loading = true;
    this.form.value['id'] = this.authService.currentUserValue.id;
    this.userService.update(this.form.value)
      .pipe(first())
      .subscribe(
        data => {
          this.alert.success('Mise à jour réussie');
          this.loading = false;
          this.submitted = false;
          this.ngOnInit();
        },
        error => {
          this.alert.error(error);
          this.loading = false;
        }
      )
  }

}
