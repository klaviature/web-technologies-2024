const getPostId = () => {

    const params = new URLSearchParams(window.location.search)

    return params.get('id')
}

const getPost = async (id) => {

    try {

        const res = await fetch(
            `https://jsonplaceholder.typicode.com/posts/${id}`
        )

        if (!res.ok) {
            throw new Error('Пост не найден')
        }

        return await res.json()

    } catch (error) {

        console.error(error)
        alert(error.message)
    }
}

const getComments = async (id) => {

    try {

        const res = await fetch(
            `https://jsonplaceholder.typicode.com/posts/${id}/comments`
        )

        if (!res.ok) {
            throw new Error('Ошибка загрузки комментариев')
        }

        return await res.json()

    } catch (error) {

        console.error(error)
        alert(error.message)

        return []
    }
}

const renderPost = (post) => {

    document.getElementById('post-title').textContent = post.title
    document.getElementById('post-body').textContent = post.body
}

const renderComments = (comments) => {

    const container = document.getElementById('comments')

    container.innerHTML = comments.map(comment => `
    
        <div class="comment">
        
            <h4>${comment.name}</h4>
            
            <p>${comment.body}</p>
            
            <span>${comment.email}</span>
            
        </div>
    
    `).join('')
}

const init = async () => {

    const id = getPostId()

    if (!id) {
        alert('ID поста не найден')
        return
    }

    const post = await getPost(id)

    if (!post) return

    renderPost(post)

    const comments = await getComments(id)

    renderComments(comments)
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init)
} else {
    init()
}