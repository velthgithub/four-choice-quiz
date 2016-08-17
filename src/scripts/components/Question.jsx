import React, {PropTypes} from 'react'
import Option from './Option';
import Result from './Result'
import NextButton from './NextButton'


class Question extends React.Component {

	isAnswered() {
		let {userAnswer} = this.props;
		return !( userAnswer === undefined || userAnswer === null );
	}

	isCorrect() {
		let {userAnswer, answer} = this.props;
		return ( answer === userAnswer );
	}

	render() {
		let {question, options, className, isLast, onNextClick, onOptionClick, questionID, userAnswer, answer} = this.props;

		return (
			<div className={'four-choice-quiz-question ' + className}>
				<h3>{question}</h3>
				<ol className="four-choice-quiz-question__options">
					{options.map((option, index) =>
						<Option
							key={index}
							onClick={() => onOptionClick(questionID, index)}
							isAnswered={this.isAnswered()}
							isSelected={(userAnswer == index + 1)}
							isCorrect={(answer == index + 1)}
						>
							{option}
						</Option>
					)}
				</ol>
				<Result
					isAnswered={this.isAnswered()}
					isCorrect={this.isCorrect()}
				/>
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
