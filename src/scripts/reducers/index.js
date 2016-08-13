import { combineReducers } from 'redux'
import ActionType from '../constants/ActionType'
const reducer = (state, action) => {
	switch (action.type) {

		default:
			return state
	}
}


const wp = (state = {}, action) => {


	switch (action.type) {

		case ActionType.RECEIVE_DATA :
			return {
				id: action.id,
				data: action.data
			}

		default:
			return state
	}
}



const reducers = combineReducers({
	wp
})

export default reducers;