import React from 'react';
import { connect } from 'react-redux';
import { compose } from 'recompose';

import { withFirebase } from '../Firebase';

const needsEmailVerification = authUser =>
  authUser &&
  !authUser.emailVerified &&
  authUser.providerData
    .map(provider => provider.providerId)
    .includes('password');

const withEmailVerification = Component => {
  class WithEmailVerification extends React.Component {
    constructor(props) {
      super(props);

      this.state = { isSent: false };
    }

    onSendEmailVerification = () => {
      this.props.firebase
        .doSendEmailVerification()
        .then(() => this.setState({ isSent: true }));
    };

    render() {
      return needsEmailVerification(this.props.authUser) ? (
        <div className="signin">
          <div className="form-sigin">
          {this.state.isSent ? (
            <p>
              Confirmation de l'e-mail envoyée: vérifiez votre courrier électronique (dossier de courrier indésirable inclus) pour un e-mail de confirmation. Actualisez cette page une fois que vous avez confirmé votre courrier électronique.
            </p>
          ) : (
            <p>
            Vérifiez votre courrier électronique: Vérifiez vos courriels (dossier de courrier indésirable inclus) pour un courrier électronique de confirmation ou envoyez un autre courrier électronique de confirmation.
            </p>
          )}

          <button
          className="input-submit"
            type="button"
            onClick={this.onSendEmailVerification}
            disabled={this.state.isSent}
          >
            Renvoyez le mail de confirmation
          </button>
          </div>
        </div>
      ) : (
        <Component {...this.props} />
      );
    }
  }

  const mapStateToProps = state => ({
    authUser: state.sessionState.authUser,
  });

  return compose(
    withFirebase,
    connect(mapStateToProps),
  )(WithEmailVerification);
};

export default withEmailVerification;
