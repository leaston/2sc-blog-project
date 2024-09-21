import './bootstrap.js';

import 'bootstrap';

/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import './styles/myStyle.css';
import './styles/app_show.css';
import { Dropdown } from 'bootstrap';
// import './styles/custom.scss';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

document.addEventListener('DOMContentLoaded', ()=> {
    new App();
})

class App {
    constructor(){
        this.enableDropdowns()
        this.handleCommentForm()
    }

    enableDropdowns() {
        const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        dropdownElementList.map(function (dropdownToggleEl){
            return new Dropdown(dropdownToggleEl)
        });
    }

    handleCommentForm(){

        const commentForm = document.querySelector('form.comment-form')

        if (null == commentForm){
            return;
        }

        commentForm.addEventListener('submit', async(e) => {
            e.preventDefault();

            const response = await fetch('/comment/add', {
                method: 'POST',
                body: new FormData(e.target)
            });

            if (!response.ok ) {
                return;
            };

            const json = await response.json();
            console.log(json);
        })

        const commentList = document.querySelector('.comment-list');

        commentForm.addEventListener('submit', async (e) => {
        // ... (code existant)
        
        const json = await response.json();
        const commentHtml = json.message;
        
        // Créer un nouvel élément et l'ajouter à la liste
        const newComment = document.createElement('div');
        newComment.innerHTML = commentHtml;
        commentList.insertBefore(newComment, commentList.firstChild);
        
        // Mettre à jour le nombre de commentaires
        const commentCount = document.getElementById('comment-count');
        commentCount.textContent = json.number_of_comment + ' commentaire(s)';
        });

    }


    
}


