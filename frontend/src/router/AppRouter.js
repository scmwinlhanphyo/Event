import React from "react";
import { Switch, Redirect, withRouter } from "react-router-dom";
import PublicRoute from "./PublicRoute";
import PrivateRoute from "./PrivateRoute";
import LoginPage from "../pages/Login/LoginPage";
import UserPage from "../pages/User/UserPage";
import EventPage from "../pages/Event/EventPage";
import Header from "../components/Header/Header";
import Footer from "../components/Footer/Footer";
import CreatePage from "../pages/Create/CreatePage";

const AppRouter = withRouter(({ location }) => {

  /**
   * make path for each component.
   */
  return (
    <>
      {
        (location.pathname !== '/admin/login' && location.pathname !== '/user/create') && <Header showMenu={true} />
      }
      <Switch>
        <PublicRoute path="/admin/login" component={LoginPage} />
        <PrivateRoute path="/admin/users" component={UserPage} />
        <PrivateRoute path="/admin/events" component={EventPage} />
        <PublicRoute path="/admin/user/create" component={CreatePage} />
        <PrivateRoute path="/admin/user/:id/update" component={CreatePage} />

        {/* Redirect all 404's to home */}
        <Redirect to='/admin/login' />
      </Switch>
      {
        (location.pathname !== '/admin/login' && location.pathname !== '/user/create') && <Footer />
      }
    </>
  )
})

export default AppRouter;
