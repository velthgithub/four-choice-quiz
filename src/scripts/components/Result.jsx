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
				<span className="four-choice-quiz-question__result-text">正解！</span>
			</div>
		)
	}
	else {
		return (
			<div
				className="four-choice-quiz-question__result four-choice-quiz-question__result--incorrect"
			>

				<span className="four-choice-quiz-question__result-text">不正解！</span>
			</div>
		)
	}

};

export default Result
