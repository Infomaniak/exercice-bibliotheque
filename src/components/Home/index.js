import React from 'react';
import { compose } from 'recompose';
import './Home.css';

import { withAuthorization, withEmailVerification } from '../Session';
import Messages from '../Messages';

const HomePage = () => (
  <div className="home">
    <div className="home-center">
    <div className="home-title">Nos Livres</div>
    <Messages />
    </div>
  </div>
);

const condition = authUser => !!authUser;

export default compose(
  withEmailVerification,
  withAuthorization(condition),
)(HomePage);
