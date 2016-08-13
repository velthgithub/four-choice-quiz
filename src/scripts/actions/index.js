import ActionType from '../constants/ActionType'
import WP from 'wpapi';
const wpapi = new WP({endpoint: '/wp-json'});
wpapi.quiz = wpapi.registerRoute('wp/v2', '/quiz/(?P<id>)');

function requestData(id) {
	return {
		type: ActionType.REQUEST_DATA,
		id
	}
}

function receiveData(id, data) {
	return {
		type: ActionType.RECEIVE_DATA,
		id,
		data,
	}
}

export function fetchData(id) {
	return function (dispatch) {
		dispatch(requestData(id));
		return wpapi.quiz().id(id).then((data) => dispatch(receiveData(id, data)));
	}
}