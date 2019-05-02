import React, {Component} from 'react';
import { BrowserRouter, Route } from 'react-router-dom';
import { scaleDown as Menu } from 'react-burger-menu'
import './App.css';

import Navigation from '../Navigation';
import LandingPage from '../Landing';
import SignUpPage from '../SignUp';
import SignInPage from '../SignIn';
import PasswordForgetPage from '../PasswordForget';
import HomePage from '../Home';
import AccountPage from '../Account';
import AdminPage from '../Admin';
import * as ROUTES from '../../constants/routes';

export default class App extends Component {
    render() {
        return (
          <BrowserRouter>
            <div>
            <Menu pageWrapId={ "page-wrap" } outerContainerId={ "outer-container" } isOpen={this.isOpen} >
                <Navigation />
             </Menu>
              <main id="page-wrap">
                <Route exact path={ROUTES.LANDING}  component={LandingPage} />
                <Route path={ROUTES.SIGN_UP} onEnter={this.onChangeRoute} component={SignUpPage} />
                <Route path={ROUTES.SIGN_IN} onEnter={this.onChangeRoute} component={SignInPage} />
                <Route path={ROUTES.PASSWORD_FORGET} onEnter={this.onChangeRoute} component={PasswordForgetPage} />
                <Route path={ROUTES.HOME} onEnter={this.onChangeRoute} component={HomePage} />
                <Route path={ROUTES.ACCOUNT} onEnter={this.onChangeRoute} component={AccountPage} />
                <Route path={ROUTES.ADMIN} onEnter={this.onChangeRoute} component={AdminPage} />
              </main>
            </div>
          </BrowserRouter>
      );
    }
}
