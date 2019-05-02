import React from 'react';
import { Link } from 'react-router-dom';
import { connect } from 'react-redux';
import './Navigation.css';

import SignOutButton from '../SignOut';
import * as ROUTES from '../../constants/routes';
import * as ROLES from '../../constants/roles';

const Navigation = ({ authUser }) =>
  authUser ? (
    <NavigationAuth authUser={authUser} />
  ) : (
    <NavigationNonAuth />
  );





const NavigationAuth = ({ authUser }) => (


  <div>
    <div className="menu-title">
      <Link className='some-value'  to={ROUTES.LANDING}>Accueil</Link>
    </div>
    <div className="menu-title">
      <Link className='some-value'  to={ROUTES.HOME}>Nos Livres</Link>
    </div>
    <div className="menu-title">
      <Link className='some-value' to={ROUTES.ACCOUNT}>Mon Compte</Link>
    </div>
    {!!authUser.roles[ROLES.ADMIN] && (
      <div className="menu-title">
        <Link className='some-value' to={ROUTES.ADMIN}>Bibliothécaire</Link>
      </div>
    )}
    <div className="menu-title">
      <SignOutButton />
    </div>
  </div>
);

const NavigationNonAuth = () => (
  <div>
  <div className="menu-title">
      <Link className='some-value' to={ROUTES.LANDING}>Accueil</Link>
    </div>
    <div className="menu-title">
      <Link className='some-value' to={ROUTES.SIGN_IN}>Se Connecter</Link>
    </div>
  </div>
);

const mapStateToProps = state => ({
  authUser: state.sessionState.authUser,
});

export default connect(mapStateToProps)(Navigation);
