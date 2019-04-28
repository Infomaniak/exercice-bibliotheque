import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavComponent } from './nav/nav.component';
import { HomeComponent } from './home/home.component';
import { BookComponent } from './book/book.component';
import { BookDialogComponent } from './book-dialog/book-dialog.component';
import { ConfirmDialogComponent } from './confirm-dialog/confirm-dialog.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { JwtInterceptor } from './jwt.Interceptor';
import { ErrorInterceptor } from './error.Interceptor';
import { AlertComponent } from './alert/alert.component';
import { AccountComponent } from './account/account.component';
import { BorrowComponent } from './borrow/borrow.component';

import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { 
  MatDialogModule, 
  MatTooltipModule, 
  MatButtonModule, 
  MatIconModule, 
  MatInputModule, 
  MatFormFieldModule,
  MatSelectModule 
} from "@angular/material";
import { BrowserAnimationsModule } from '@angular/platform-browser/animations'
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { OwlDateTimeModule, OwlNativeDateTimeModule } from 'ng-pick-datetime';

@NgModule({
  declarations: [
    AppComponent,
    NavComponent,
    HomeComponent,
    BookComponent,
    BookDialogComponent,
    ConfirmDialogComponent,
    LoginComponent,
    RegisterComponent,
    AlertComponent,
    AccountComponent,
    BorrowComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    MatInputModule,
    MatIconModule,
    MatButtonModule,
    MatFormFieldModule,
    MatDialogModule,
    MatTooltipModule,
    MatSelectModule,
    BrowserAnimationsModule,
    OwlDateTimeModule,
    OwlNativeDateTimeModule
  ],
  entryComponents: [BookDialogComponent, ConfirmDialogComponent],
  providers: [
    { provide: HTTP_INTERCEPTORS, useClass: JwtInterceptor, multi: true },
    { provide: HTTP_INTERCEPTORS, useClass: ErrorInterceptor, multi: true }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
