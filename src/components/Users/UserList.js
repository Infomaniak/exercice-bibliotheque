import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { connect } from 'react-redux';
import { compose } from 'recompose';

import { withFirebase } from '../Firebase';
import * as ROUTES from '../../constants/routes';

class UserList extends Component {
  constructor(props) {
    super(props);

    this.state = {
      loading: false,
    };
  }

  componentDidMount() {
    if (!this.props.users.length) {
      this.setState({ loading: true });
    }

    this.props.firebase.users().on('value', snapshot => {
      this.props.onSetUsers(snapshot.val());

      this.setState({ loading: false });
    });
  }

  componentWillUnmount() {
    this.props.firebase.users().off();
  }

  render() {
    const { users } = this.props;
    const { loading } = this.state;

    return (
      <div>
        <ul>
        <table>
        <thead>
               <tr>
                 <th>Email</th>
                 <th>Nom</th>
                 <th>Plus</th>
               </tr>
             </thead>
        <tbody>

        {loading &&
          <tr>
            <td data-column="Email">Chargement...</td>
            <td data-column="Nom">Chargement...</td>
          </tr>
        }
          {users.map(user => (
              <tr>
                <td data-column="Email">{user.email}</td>
                <td data-column="Nom">{user.username}</td>
                <td className="detail" ><Link className="detail-text" to={`${ROUTES.ADMIN}/${user.uid}`}>Details</Link></td>
              </tr>
          ))}
          </tbody>
          </table>

        </ul>
      </div>
    );
  }
}

const mapStateToProps = state => ({
  users: Object.keys(state.userState.users || {}).map(key => ({
    ...state.userState.users[key],
    uid: key,
  })),
});

const mapDispatchToProps = dispatch => ({
  onSetUsers: users => dispatch({ type: 'USERS_SET', users }),
});

export default compose(
  withFirebase,
  connect(
    mapStateToProps,
    mapDispatchToProps,
  ),
)(UserList);
