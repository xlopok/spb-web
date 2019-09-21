$(document).ready(function () {
   $('.btn').on('click', function (e) {
       e.preventDefault();

       let emailValue = $('.emailInput').val();

       if (emailValue === '') {
           let toPasteUser = document.querySelector('.users-to-paste');
           toPasteUser.textContent = '';
           toPasteUser.classList.add('red-color');
           toPasteUser.classList.remove('green-color');
           toPasteUser.textContent = 'Поле email не может быть пустым!';
           return;
       }

       //отправляем ajax
       $.ajax({
           method:"POST",
           url: 'json',
           data: {email: emailValue},
           dataType: "JSON",
           success: function (data) {

               if (data.length && emailValue !== '') {
                    let user = data[0];

                    let userTemplate = document.querySelector('#user-template')
                        .content
                        .querySelector('.user-similar-item');

                   let renderUser = function (usr) {
                       let userElement = userTemplate.cloneNode(true);

                       userElement.querySelector('.user-email').textContent = usr.email + ' - ';
                       userElement.querySelector('.user-name').textContent = usr.name + ' ' + usr.sname;
                       userElement.querySelector('.user-id').textContent = '[id = ' + usr.user_id + ']';

                       return userElement;
                   };

                   let toPasteUser = document.querySelector('.users-to-paste');
                   toPasteUser.textContent = '';
                   toPasteUser.classList.add('green-color');
                   toPasteUser.classList.remove('red-color');

                   let fragment = document.createDocumentFragment();

                   fragment.appendChild(renderUser(user));
                   toPasteUser.appendChild(fragment);

               } else {
                   let toPasteUser = document.querySelector('.users-to-paste');
                   toPasteUser.textContent = '';
                   toPasteUser.classList.add('red-color');
                   toPasteUser.classList.remove('green-color');
                   toPasteUser.textContent = 'Записей для ' + emailValue +  ' не было обнаружено!'
                }
           }
       })
    });


   $('.emailInput').keyup(function (e) {
       e.preventDefault();

       let emailValue = $('.emailInput').val();

       if (emailValue === '') {
           let toPasteUser = document.querySelector('.users-to-paste');
           toPasteUser.textContent = '';
           toPasteUser.classList.add('red-color');
           toPasteUser.classList.remove('green-color');
           toPasteUser.textContent = 'Поле email не может быть пустым!';
           return;
       }

       $.ajax({
           method:"POST",
           url: 'json-like',
           data: {email: emailValue},
           dataType: "JSON",
           success: function (data2) {
               if (data2.length && emailValue !== '') {
                   let users = data2;

                   let userTemplate = document.querySelector('#user-template')
                       .content
                       .querySelector('.user-similar-item');

                   let renderUser = function (usr) {
                       let userElement = userTemplate.cloneNode(true);

                       userElement.querySelector('.user-email').textContent = usr.email + ' - ';
                       userElement.querySelector('.user-name').textContent = usr.name + ' ' + usr.sname;
                       userElement.querySelector('.user-id').textContent = '[id = ' + usr.user_id + ']';

                       return userElement;
                   };

                   let toPasteUser = document.querySelector('.users-to-paste');
                   toPasteUser.textContent = '';
                   toPasteUser.classList.add('green-color');
                   toPasteUser.classList.remove('red-color');

                   let fragment = document.createDocumentFragment();

                   for(let i = 0; i < users.length; i++) {
                       fragment.appendChild(renderUser(users[i]));
                   }

                   toPasteUser.appendChild(fragment);

               } else {
                   let toPasteUser = document.querySelector('.users-to-paste');
                   toPasteUser.textContent = '';
                   toPasteUser.classList.add('red-color');
                   toPasteUser.classList.remove('green-color');
                   toPasteUser.textContent = 'Записей для ' + emailValue +  ' не было обнаружено!'
               }
           }
       })
   })
});