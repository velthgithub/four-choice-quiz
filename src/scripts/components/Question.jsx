import React, { PropTypes } from 'react'
import Option from './Option';

const Question = ({ question, options, onNextClick, className }) => {
	return (
		<div className={className}>
			<h3>{question}</h3>
			<ul>
				{options.map( (option, index ) =>
					<Option
						key={index}
					>
						{option}
					</Option>
				)}
			</ul>

			<a className="btn" onClick={onNextClick}>次の問題へ</a>
		</div>
	)
}

export default Question
