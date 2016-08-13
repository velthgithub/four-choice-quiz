import React, { PropTypes } from 'react'
import Option from './Option';

const Question = ({options}) => {
	return (
		<div>
			<ul>
				{options.map( (option, index ) =>
					<Option
						key={index}
					>
						{option}
					</Option>
				)}
			</ul>
		</div>
	)
}

export default Question
