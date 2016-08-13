import { combineReducers } from 'redux'
import ActionType from '../constants/ActionType'
const reducer = (state, action) => {
	switch (action.type) {

		default:
			return state
	}
}


const request = (state = {}, action) => {

	switch (action.type) {

		case ActionType.RECEIVE_DATA :
			return {
				id: action.id,
				questions: action.data.fcq.questions,
				images: action.data.fcq.images,
			}

		default:
			return state
	}
}




const reducers = combineReducers({
	request
})

export default reducers;