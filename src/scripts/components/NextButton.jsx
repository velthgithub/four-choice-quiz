import React, { PropTypes } from 'react'
import GoResult from '../containers/GoResult'

const NextButton = ( { onClick, isAnswered, isLast } ) => {

	if(isLast) {
		return (
			<GoResult
				className="btn"
				isAnswered={isAnswered}

			/>
		)
	}

	return (
		<a
			className="btn"
			onClick={onClick}
			style={{
				display: (isAnswered) ? 'block' : 'none'
			}}
		>次の問題へ</a>
	);

};

export default NextButton
