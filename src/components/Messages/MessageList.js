import React from 'react';
import * as ROLES from '../../constants/roles';

import MessageItem from './MessageItem';

const MessageList = ({
  authUser,
  messages,
  onFollowMessage,
  onUnFollowMessage,
  onRemoveMessage,
  onSaveMessage,
}) => (
  <ul>
  <table>
    <thead>
     <tr>
       <th>Titre</th>
       <th>Auteur</th>
       {!!authUser.roles[ROLES.ADMIN] && (<th>Editer</th>)}

       {!!authUser.roles[ROLES.ADMIN] ? (<th>Supprimer</th>) : (<th>S'abonner</th>)}
       {!!authUser.roles[ROLES.ADMIN] && (<th>Emprunter par</th>)}
     </tr>
    </thead>
    <tbody>
      {messages.map(message => (
        <MessageItem
          authUser={authUser}
          key={message.uid}
          message={message}
          onFollowMessage={onFollowMessage}
          onUnFollowMessage={onUnFollowMessage}
          onRemoveMessage={onRemoveMessage}
          onSaveMessage={onSaveMessage}
        />
      ))}
      </tbody>
    </table>
  </ul>
);

export default MessageList;
