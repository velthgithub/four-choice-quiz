import React from 'react'
import ReactDOM from 'react-dom'
import App from './components/App'
import { createStore, applyMiddleware } from 'redux'
import { Provider } from 'react-redux'
import reducers from './reducers'
import { fetchData } from './actions';
import createLogger from 'redux-logger';
import thunk        from 'redux-thunk';
const logger = createLogger();

const store = createStore(reducers, applyMiddleware( thunk, logger ) );

let container = document.querySelector('.four-choice-quiz' );
let id = container.dataset.id;

store.dispatch(fetchData(id)).then(() =>
	console.log(store.getState())
)

ReactDOM.render(
	<Provider store={store}>
		<App />
	</Provider>,
	container
);