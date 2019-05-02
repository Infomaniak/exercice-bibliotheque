import React from 'react';
import './landing.css';

const Landing = () => (
  <div className="landing">

    <div className="component">
    <div className="hello-message">Bienvenue dans notre Bibliotheque ! Bonne lecture et bonne journée !</div>

				<ul className="align">

					<li>
						<figure className='book'>


							<ul className='hardcover_front'>
								<li>
									<div className="coverDesign custom">
										<span className="ribbon">FUN</span>
										<h1>Custom</h1>
										<p>Book Cover</p>
									</div>
								</li>
								<li></li>
							</ul>


							<ul className='page'>
								<li></li>
								<li>
									<a className="btn" href="/home">Voir les livres</a>
								</li>
								<li></li>
								<li></li>
								<li></li>
							</ul>


							<ul className='hardcover_back'>
								<li></li>
								<li></li>
							</ul>
							<ul className='book_spine'>
								<li></li>
								<li></li>
							</ul>

						</figure>
					</li>
				</ul>
			</div>


  </div>
);

export default Landing;
