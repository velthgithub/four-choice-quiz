import React, { PropTypes } from 'react'
import Option from './Option';
import Result from './Result'
import NextButton from './NextButton'


class Question extends React.Component {

	isAnswered() {
		let { userAnswer } = this.props;
		return !( userAnswer === undefined || userAnswer === null );
	}

	isCorrect() {
		let { userAnswer, answer } = this.props;
		return  ( answer === userAnswer );
	}

	render() {
		let { question, options, className, isLast, onNextClick, onOptionClick, questionID } = this.props;

		return (
			<div className={className}>
				<h3>{question}</h3>
				<Result
					isAnswered={this.isAnswered()}
					isCorrect={this.isCorrect()}
				/>
				<ul>
					{options.map( (option, index ) =>
						<Option
							key={index}
							onClick={() => onOptionClick(questionID,index)}
						>
							{option}
						</Option>
					)}
				</ul>

				<NextButton
					onClick={onNextClick}
					isLast={isLast}
					isAnswered={this.isAnswered()}
				/>

			</div>
		)
	}
}

export default Question
