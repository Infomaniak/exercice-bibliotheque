import React, { Component } from 'react';
import * as ROLES from '../../constants/roles';


class MessageItem extends Component {
  constructor(props) {
    super(props);

    this.state = {
      editMode: false,
      text: this.props.message.text,
      author: this.props.message.author
    };
  }

onEditMessage(messageUid){
  this.setState({editMode: true});
    }

onSaveMessageNow(text, author, uid){
  this.props.onSaveMessage(text, author, uid);
  this.setState({editMode: false});
}

    onChangeText = event => {
      this.setState({ text: event.target.value });
    };
    onChangeAuthor = event => {
      this.setState({ author: event.target.value });
    };

  render() {
    const { authUser, message, onRemoveMessage, onFollowMessage, onUnFollowMessage } = this.props;


    const Button = () => {

      if (!!authUser.roles[ROLES.ADMIN]) { return (
        <td data-column="Supprimer"  className="delete" onClick={() => onRemoveMessage(message.uid)}>
        Supprimer
        </td>
      ) } else {
          if (message.subscriber) {
            if (message.subscriber === authUser.uid) { return (
              <td data-column="Supprimer"  className="delete" onClick={() => onUnFollowMessage(message.uid)}>
              Rendre
              </td>
          )  } else { return (
              <td data-column="Supprimer">
              Non Disponible
              </td>
          )  }
        } else { return (
            <td data-column="Supprimer"  className="delete" onClick={() => onFollowMessage(message.uid, authUser)}>
            Emprunter
            </td>
        )  }
      }
    };



    const Editer = () => {
      if (this.state.editMode) {
        return (
          <td data-column="Editer"  className="delete" onClick={() => this.onSaveMessageNow(this.state.text, this.state.author, message.uid)}>
            Enregistrer
          </td>
        )
      } else {
        return (
          <td data-column="Editer"  className="delete" onClick={() => this.onEditMessage(message.uid)}>
            Editer
          </td>
        )
      }
      };


    return (
      <tr>
        <td data-column="Titre">{this.state.editMode ? (
          <input
          className="input-edit"
          type="text"
          value={this.state.text}
          onChange={this.onChangeText}
          placeholder="Titre"
          />) : (message.text)}
        </td>
        <td data-column="Auteur">{this.state.editMode ? (
          <input
          className="input-edit"
          type="text"
          value={this.state.author}
          onChange={this.onChangeAuthor}
          placeholder="Titre"
          />) : (message.author)}</td>
        {!!authUser.roles[ROLES.ADMIN] &&
          <Editer />
      }
        <Button />
        {(!!authUser.roles[ROLES.ADMIN] && message.subscriber) &&
          <td data-column="User">{message.email}</td>
        }
      </tr>
    );
  }
}

export default MessageItem;
