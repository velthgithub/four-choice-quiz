import React, { PropTypes } from 'react'

const Result = ( { isAnswered, isCorrect } ) => {

	if( !isAnswered ) {
		return (<div></div>);
	}

	if( isCorrect ) {
		return (
			<div>正解！</div>
		)
	}
	else {
		return (
			<div>不正解！</div>
		)
	}

};

export default Result
