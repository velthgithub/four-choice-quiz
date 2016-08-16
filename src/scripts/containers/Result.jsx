import React, { PropTypes } from 'react'
import { connect } from 'react-redux'
const isResult = function ( current, index ) {
	if( current == index ){
		return 'active';
	}

	return 'deactive'
}


const Result = ({ questions, current }) => {
	return (
		<div className={ isResult(questions.length, current) }>
			<h3>結果</h3>
		</div>
	)
}

export default Result



const mapStateToProps = (state) => {
	return {
		questions: state.questions.questions,
		current: state.screen.current
	}
}



const mapDispatchToProps = (dispatch) => {
	return {
	}
}

export default connect(
	mapStateToProps,
	mapDispatchToProps
)(Result)
