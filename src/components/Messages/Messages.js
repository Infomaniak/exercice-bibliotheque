import React, { Component } from 'react';
import { connect } from 'react-redux';
import { compose } from 'recompose';

import { withFirebase } from '../Firebase';
import MessageList from './MessageList';
import * as ROLES from '../../constants/roles';


class Messages extends Component {
  constructor(props) {
    super(props);

    this.state = {
      text: '',
      author: '',
      loading: false,
    };
  }

  componentDidMount() {
    this.props.onSetMessagesLimit(this.props.limit + 200);

    if (!this.props.messages.length) {
      this.setState({ loading: true });
    }

    this.onListenForMessages();
  }

  componentDidUpdate(props) {
    if (props.limit !== this.props.limit) {
      this.onListenForMessages();
    }
  }

  onListenForMessages = () => {
    this.props.firebase
      .messages()
      .orderByChild('createdAt')
      .limitToLast(this.props.limit)
      .on('value', snapshot => {
        this.props.onSetMessages(snapshot.val());

        this.setState({ loading: false });
      });
  };

  componentWillUnmount() {
    this.props.firebase.messages().off();
  }

  onChangeText = event => {
    this.setState({ text: event.target.value });
  };
  onChangeAuthor = event => {
    this.setState({ author: event.target.value });
  };

  onCreateMessage = (event, authUser) => {
    this.props.firebase.messages().push({
      text: this.state.text,
      author: this.state.author,
      userId: authUser.uid,
      createdAt: this.props.firebase.serverValue.TIMESTAMP,
    });

    this.setState({ text: '', author:'' });

    event.preventDefault();
  };

  onFollowMessage = (uid, authUser) => {
    console.log(authUser.email);
    var newData={
        subscriber: authUser.uid,
        email: authUser.email
    }
    this.props.firebase.message(uid).update(newData);
  };

  onSaveMessage = (text, author, uid) => {
    var newData={
        text: text,
        author: author
    }
    this.props.firebase.message(uid).update(newData);
  };

  onUnFollowMessage = (uid) => {
    var newData={
        subscriber: null,
        email: null
    }
    this.props.firebase.message(uid).update(newData);

  };

  onRemoveMessage = uid => {
    this.props.firebase.message(uid).remove();
  };


  onNextPage = () => {
  };

  render() {
    const { messages } = this.props;
    const { text, author, loading } = this.state;

    return (
      <div>

        {loading && <div>Chargement des livres ...</div>}

        {messages && (
          <MessageList
            authUser={this.props.authUser}
            messages={messages}
            onUnFollowMessage={this.onUnFollowMessage}
            onFollowMessage={this.onFollowMessage}
            onRemoveMessage={this.onRemoveMessage}
            onSaveMessage={this.onSaveMessage}
          />
        )}

        {!messages && <div>There are no messages ...</div>}


        {!!this.props.authUser.roles[ROLES.ADMIN] && (
        <form
          onSubmit={event =>
            this.onCreateMessage(event, this.props.authUser)
          }
        >
          <input
            className="input-form"
            type="text"
            value={text}
            onChange={this.onChangeText}
            placeholder="Titre"

          />
          <br/>
          <input
            className="input-form"
            type="text"
            value={author}
            onChange={this.onChangeAuthor}
            placeholder="Auteur"
          />
          <br/>
          <button className="input-submit" type="submit">Ajouter le livre</button>
        </form>
      )}
      </div>
    );
  }
}

const mapStateToProps = state => ({
  authUser: state.sessionState.authUser,
  messages: Object.keys(state.messageState.messages || {}).map(
    key => ({
      ...state.messageState.messages[key],
      uid: key,
    }),
  ),
  limit: state.messageState.limit,
});

const mapDispatchToProps = dispatch => ({
  onSetMessages: messages =>
    dispatch({ type: 'MESSAGES_SET', messages }),
  onSetMessagesLimit: limit =>
    dispatch({ type: 'MESSAGES_LIMIT_SET', limit }),
});

export default compose(
  withFirebase,
  connect(
    mapStateToProps,
    mapDispatchToProps,
  ),
)(Messages);
