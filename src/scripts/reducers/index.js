import { combineReducers } from 'redux'
import ActionType from '../constants/ActionType'
"use strict";

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

const page = ( state = { id: 0, permalink: ''}, action ) => {
	switch (action.type) {

		case ActionType.INIT :
			return {
				id: action.id,
				currentid: action.currentid
			}

		default:
			return state
	}
}

const resultImages = (state = [], action) => {
	switch (action.type) {
		case ActionType.RECEIVE_DATA :
			return action.data.fcq.images;

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


const question = (state, action) => {
	switch (action.type) {
		case ActionType.ANSWER_QUESTION:

			if (state.id !== action.questionID) {
				return state
			}
			if ( state.userAnswer === undefined || state.userAnswer === null ) {
				state.userAnswer = action.userAnswer;
			}

			//for debug.
			//state.userAnswer = action.userAnswer;

			return state;

		default:
			return state;
	}

}


const questions =  (state = [], action) => {
	switch (action.type) {
		case ActionType.RECEIVE_DATA :
			return action.data.fcq.questions;

		case ActionType.ANSWER_QUESTION:
			return state.map(s =>
				question(s, action)
			)
			return state;

		case ActionType.NEXT_QUESTION:
			return state;

		default:
			return state;

	}
}




const reducers = combineReducers({
	page,
	questions,
	screen,
	resultImages,
	request,
})

export default reducers;