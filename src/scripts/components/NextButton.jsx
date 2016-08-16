import React, { PropTypes } from 'react'

const NextButton = ( { onNextClick, isAnswered, isLast } ) => {
	let message = "次の問題へ";
	if(isLast) {
		message= "結果を見る";
	}

	return (
		<a
			className="btn"
			onClick={onNextClick}
			style={{
				display: (isAnswered) ? 'block' : 'none'
			}}
		>{message}</a>
	);

};

export default NextButton
