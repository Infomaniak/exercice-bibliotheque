import React from 'react';

import { withFirebase } from '../Firebase';

const SignOutButton = ({ firebase }) => (
  <button className='some-value' type="button" onClick={firebase.doSignOut}>
    Déconnexion
  </button>
);

export default withFirebase(SignOutButton);
