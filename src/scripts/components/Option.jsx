import React, { PropTypes } from 'react'

const Option = ( {children, onClick ,isCorrect, isSelected , isAnswered } ) => {
	let className = 'four-choice-quiz-question__option';
	if( isAnswered ) {
		if(  isCorrect ) {
			className = className + ' four-choice-quiz-question__option--correct';
		}

		if ( isSelected && !isCorrect ) {
			className = className + ' four-choice-quiz-question__option--incorrect';
		}
	}


	return (
		<li
			className={className}
			onClick={onClick}
		>
			{children}
		</li>
	)
}

// Option.propTypes = {
// 	selected: PropTypes.bool.isRequired,
// 	text: PropTypes.string.isRequired
// }

export default Option
