function removeChilds(node) {
    while (node.firstChild) {
        node.removeChild(node.lastChild);
    }
}

function findCommentEl(comment) {
    const commentElData = document.querySelector(`data[value="comment-${comment.numSeqCom}-${comment.numArt}"`);
    return commentElData?commentElData.parentElement:false;
}

function addComment(comment) {
    const template = document.getElementById("template-comment");
    const commentEl = document.importNode(template.content, true);


    commentEl.querySelector('.comment-id').value = `comment-${comment.numSeqCom}-${comment.numArt}`;
    commentEl.querySelector('.comment-author').innerText = comment.pseudoMemb;
    commentEl.querySelector('.comment-created-at').innerText = `Créé le ${comment.dtCreCom}`;
    commentEl.querySelector('.comment-modified-at').innerText = `Modifié le ${comment.dtModCom}`;
    commentEl.querySelector('.comment-content').innerText = comment.libCom;

    commentsEl.appendChild(commentEl);
}

function addCommentPlus(commentPlus) {
    const template = document.getElementById("template-commentplus");
    const commentPlusEl = document.importNode(template.content, true);

    const commentEl = findCommentEl(commentPlus);
    if(!commentEl) return;

    commentPlusEl.querySelector('.comment-id').value = `commentplus-${commentPlus.numSeqCom}-${commentPlus.numArt}`;
    commentPlusEl.querySelector('.comment-author').innerText = commentPlus.pseudoMemb;
    commentPlusEl.querySelector('.comment-created-at').innerText = `Créé le ${commentPlus.dtCreCom}`;
    commentPlusEl.querySelector('.comment-modified-at').innerText = `Modifié le ${commentPlus.dtModCom}`;
    commentPlusEl.querySelector('.comment-content').innerText = commentPlus.libCom;

    commentEl.after(commentPlusEl);
}

function updateComment(comment) {
    const commentElData = document.querySelector(`data[value="comment-${comment.numSeqCom}-${comment.numArt}"`);
    const commentEl = commentElData.parentElement;

    commentEl.querySelector('.comment-author').innerText = comment.pseudoMemb;
    commentEl.querySelector('.comment-created-at').innerText = `Créé le ${comment.dtCreCom}`;
    commentEl.querySelector('.comment-modified-at').innerText = `Modifié le ${comment.dtModCom}`;
    commentEl.querySelector('.comment-content').innerText = comment.libCom;
}

function fetchComments() {
    const data = { 
        numArt,
    };

    $.get( 
        urlFetchComment,
        data,
        function(data) {
            if(data.errors || !data.result) return;            
            
            if(data.result.comments) {
                removeChilds(commentsEl);

                for(const comment of data.result.comments) {
                    addComment(comment);
                }
            }
        } 
    );

}

function postComment() {
    const data = { 
        numArt,
        libCom: commentInput.value
    };

    $.post( 
        urlPostComment,
        data,
        function(data) {
            if(data.errors || !data.result) return;            
                
            
        } 
    );

}



function fetchCommentsPlus() {
    const data = { 
        numArt,
    };

    $.get( 
        urlFetchCommentPlus,
        data,
        function(data) {
            if(data.errors || !data.result) return;            
            
            if(data.result.commentsplus) {
                for(const commentPlus of data.result.commentsplus) {
                    addCommentPlus(commentPlus);
                }
            }
        } 
    );
}