import React, { PropTypes } from 'react'

const Result = ( { isAnswered, isCorrect } ) => {

	if( !isAnswered ) {
		return (<div className="four-choice-quiz-question__result four-choice-quiz-question__result--empty"></div>);
	}

	if( isCorrect ) {
		return (
			<div 
				className="four-choice-quiz-question__result four-choice-quiz-question__result--correct"
			>
				正解！
			</div>
		)
	}
	else {
		return (
			<div
				className="four-choice-quiz-question__result four-choice-quiz-question__result--incorrect"
			>
				不正解！
			</div>
		)
	}

};

export default Result
