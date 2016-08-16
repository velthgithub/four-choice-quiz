import { combineReducers } from 'redux'
import ActionType from '../constants/ActionType'
"use strict";
const reducer = (state, action) => {
	switch (action.type) {

		default:
			return state
	}
}

const status = ( state = {}, action ) => {

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

const question = (state, action) => {
	switch (action.type) {
		case ActionType.RECEIVE_DATA :
			return {
				id: action.id,
				questions: action.data.fcq.questions,
				images: action.data.fcq.images,
			}

		case ActionType.NEXT_QUESTION:
			return state;

		case ActionType.ANSWER_QUESTION:
			return state;

		default:
			return state;

	}
}

const result = ( state = {}, action ) => {
	switch (action.type) {
		case ActionType.RECEIVE_DATA :
			return {
				images: action.data.fcq.images,
			}

		default:
			return state;

	}
}

const screen = ( state = {
	current: 0,
}, action ) => {

	switch (action.type) {
		case ActionType.NEXT_QUESTION:
			return {
				current: action.questionIndex,
			}

		default:
			return state;

	}
}

const questions =  (state = {
	currentIndex:0,
}, action) => {
	switch (action.type) {
		case ActionType.RECEIVE_DATA :
			return {
				questions: action.data.fcq.questions,
				images: action.data.fcq.images,
			}

		case ActionType.NEXT_QUESTION:
			return state;

		case ActionType.ANSWER_QUESTION:
			return state;

		default:
			return state;

	}
}




const reducers = combineReducers({
	request,
	questions,
	result,
	screen
})

export default reducers;