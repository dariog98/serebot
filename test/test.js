const createMessage = (data) => {
    const message = document.createElement('div')
    message.className = `card ${data.type === 'response' ? 'bg-body-tertiary me-5' : 'ms-5'}`
    const body = document.createElement('div')
    body.className = 'card-body'

    const textContent = document.createElement('div')
    textContent.className = 'line-break'
    textContent.append(data.text)

    body.append(textContent)
    message.append(body)
    return message
}

const getBotResponse = async (message, messagesBox) => {
    const response = await fetch('http://localhost/test/request.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(message)
    })
    const responseMessage = await response.json()
    responseMessage.type = 'response'
    messagesBox.addMessage(createMessage(responseMessage))
}

const getMessagesBox = () => {
    const body = document.getElementById('messages')

    const addMessage = (message) => {
        setTimeout(() => {
            body.append(message)
            body.scroll({ top: body.scrollHeight, behavior: 'smooth' })  
        }, 500)
    }

    const clear = () => {
        body.textContent = ''
    }

    return {
        body,
        addMessage,
        clear
    }
}

const getSendForm = (messagesBox) => {
    const form = document.getElementById('send-form')

    form.addEventListener('submit', (event) => {
        event.preventDefault()
        const type = 'user'
        const text = event.target.elements['text'].value
        const date = Date.now()
        const entities = []
        
        text.split(' ').reduce((ac, current) => {
            const word = current
            if (word.indexOf('/') > -1) {
                const entity = { type: 'bot_command', offset: ac, length: word.length }
                entities.push(entity)
            }
            return ac + word.length
        }, 0)
    
        const message = { type, text, date, entities }
        form.reset()
        messagesBox.addMessage(createMessage(message))
        getBotResponse(message, messagesBox)
    })

    return form
}

const MessagesBox = getMessagesBox()
const Form = getSendForm(MessagesBox)

MessagesBox.addMessage(createMessage({
    type: "response",
    text: "hello"
}))