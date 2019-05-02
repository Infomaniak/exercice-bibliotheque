import React from 'react';
import { Switch, Route } from 'react-router-dom';
import { compose } from 'recompose';
import './Admin.css';


import { withAuthorization, withEmailVerification } from '../Session';
import { UserList, UserItem } from '../Users';
import * as ROLES from '../../constants/roles';
import * as ROUTES from '../../constants/routes';

const AdminPage = () => (
  <div className="bibliothecaire">
    <div className="center-bibliothecaire">
      <div className="title-bibliothecaire">Bibliothecaire</div>
      <p>La page Bibliothecaire est accessible uniquement aux Bibliothecaire connectés.</p>
      <br/>
      <Switch>
        <Route exact path={ROUTES.ADMIN_DETAILS} component={UserItem} />
        <Route exact path={ROUTES.ADMIN} component={UserList} />
      </Switch>
    </div>
  </div>
);

const condition = authUser =>
  authUser && !!authUser.roles[ROLES.ADMIN];

export default compose(
  withEmailVerification,
  withAuthorization(condition),
)(AdminPage);
