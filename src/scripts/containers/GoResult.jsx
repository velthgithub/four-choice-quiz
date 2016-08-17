import React, { PropTypes } from 'react'
import { connect } from 'react-redux'
import $ from 'jquery'


const getResultLink = ( id, currentid, point ) => {
	"use strict";
	let data = {
		post_type: 'quiz',
		p: id,
		point: point,
		embedid: currentid

	}
	return '/?' + $.param(data);
}

const isCorrect = ( question ) => {
	return ( question.answer == question.userAnswer )
}

const getPoint = (questions) => {

	return questions.filter( isCorrect ).length;
}


class GoResult extends React.Component {

	render() {
		let { resultLink, isAnswered } = this.props;
		return (
			<a
				className="btn"
				style={{
					display: (isAnswered) ? 'block' : 'none'
				}}
				href={resultLink}
			>結果を見る</a>
		);
	}
}


const mapStateToProps = (state) => {
	return {
		resultLink: getResultLink(state.page.id, state.page.currentid, getPoint( state.questions ) )
	}
};


const mapDispatchToProps = (dispatch) => {
	return {
	}
}

export default connect(
	mapStateToProps,
	mapDispatchToProps
)(GoResult)

